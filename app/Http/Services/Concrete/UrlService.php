<?php


namespace App\Http\Services\Concrete;

use App\Http\Repositories\Absr\IUrlRepository;
use App\Http\Repositories\Concrete\UrlRepository;
use App\Http\Services\Abstr\IUrlService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class UrlService
 * @package App\Http\Services\Concrete
 */
class UrlService implements IUrlService
{
    /**
     * @var UrlRepository
     */
    protected $repository;

    /**
     * UrlService constructor.
     * @param IUrlRepository $repository
     */
    public function __construct(IUrlRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Method for saving the url
     *
     * @param string $url
     * @param int $idUser
     * @return JsonResponse
     */
    public function saveUrl(string $url, int $idUser): JsonResponse
    {
        if (empty($this->repository->check($idUser, $url))) {
            $inserted = $this->repository->saveUrl([
                'idUser' => $idUser,
                'url' => $url,
                'shortUrl' => str_random(6)
            ]);
            return new JsonResponse($inserted);
        } else {
            return new JsonResponse([
                'error' => 'You have already saved that url'
            ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Method for deleting the url
     *
     * @param string $url
     * @param int $idUser
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteUrl(string $url, int $idUser): JsonResponse
    {
        $url = $this->repository->check($idUser, $url);
        if (!empty($url)) {
            if ($this->repository->deleteUrl($url)) {
                return new JsonResponse([
                    'message' => 'Successfully deleted the url'
                ]);
            }
        } else {
            return new JsonResponse([
                'error' => 'You did not save that url'
            ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Method for counting different users of the same url
     *
     * @param string $url
     * @return JsonResponse
     */
    public function countUrlDuplicates(string $url): JsonResponse
    {
        return new JsonResponse([
            'count' => $this->repository->urlCount($url)
        ]);
    }

    /**
     * Redirect user from the short url
     *
     * @param string $shortUrl
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToShortUrl(string $shortUrl)
    {
        $url = $this->repository->findByShortUrl($shortUrl);

        if (!empty($url)) {
            return redirect($url->url);
        } else {
            return abort(Response::HTTP_NOT_FOUND);
        }
    }
}
