<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Http\Services\Abstr\IUrlService;
use App\Http\Services\Concrete\UrlService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UrlController
 * @package App\Http\Controllers
 */
class UrlController extends Controller
{
    /**
     * @var UrlService
     */
    protected $service;

    /**
     * UrlController constructor.
     * @param IUrlService $service
     */
    public function __construct(IUrlService $service)
    {
        $this->service = $service;
    }

    /**
     * Route for saving the url
     *
     * @param UrlRequest $request
     * @return JsonResponse
     */
    public function saveUrl(UrlRequest $request)
    {
        return $this->service->saveUrl($request->get('url'), Auth::id());
    }

    /**
     * Route for deleting the url
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteUrl(Request $request)
    {
        return $this->service->deleteUrl($request->get('url'), Auth::id());
    }

    /**
     * Route for counting users with the same url
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function countUrlDuplicates(Request $request)
    {
        return $this->service->countUrlDuplicates($request->get('url'));
    }

    /**
     * Route for redirecting the short url
     *
     * @param string $shortUrl
     * @return JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectShortUrl(string $shortUrl)
    {
        return $this->service->redirectToShortUrl($shortUrl);
    }
}
