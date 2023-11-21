<?php

namespace App\Http\Controllers;

use App\Services\LinkToService;
use Illuminate\Http\Request;

class LinkToController extends Controller
{
    protected $linktoService;

    public function __construct(LinkToService $linktoService)
    {
        $this->linktoService = $linktoService;
    }

    public function store(Request $request)
    {
        return $this->linktoService->createLinkTo($request->all());
    }

    public function getLinkToList()
    {
        return $this->linktoService->getAll();
    }

    public function show($id)
    {
        return $this->linktoService->getOne($id);
    }

    public function delete($id)
    {
        return $this->linktoService->delete($id);
    }
}
