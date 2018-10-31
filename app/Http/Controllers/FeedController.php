<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use willvincent\Feeds\Facades\FeedsFacade;

class FeedController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $instagramFeed = 'https://queryfeed.net/instagram?q='.$user;
        $feed = FeedsFacade::make($instagramFeed);
        $items = $feed->get_items();

        $data = [];
        foreach ($items as $item)
        {
            $publishedDate = Carbon::make($item->data['child']['']['pubDate'][0]['data']);
            $itemData['title'] =  trim(preg_replace('/\s+/', ' ', $item->data['child']['']['title'][0]['data']));
            $itemData['image'] = $item->data['child']['']['enclosure'][0]['attribs']['']['url'];
            $imageSize = getimagesize($itemData['image']);
            $itemData['w'] = $imageSize[0];
            $itemData['h'] = $imageSize[1];
            $itemData['pubDate'] = $publishedDate->format('r');
            array_push($data, $itemData);
        }

        $content = View::make('feed')->with(compact('user', 'data'));

        return Response::make($content, '200')->header('Content-Type', 'text/xml');

    }

}
