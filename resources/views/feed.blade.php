{{ Request::header('Content-Type : application/xml') }}
<rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
        <title>
            Instagram Image MRSS for {{$user}}
        </title>
        <link>
        {{url($user)}}
        </link>
        <generator>Penguin Instafeed</generator>
        <ttl>3</ttl>
        @foreach($data as $item)
        <item>
            <title>{{$item['title']}}</title>
            {{--<pubDate>2017- 0-SaT 8:26:27.000z</pubDate>--}}
            <pubDate>{{$item['pubDate']}}</pubDate>
            <link>
            {{$item['image']}}
            </link>
            <description>{{$item['title']}}</description>
            <guid isPermalink="false">{{$item['title']}}</guid>
            <media:content url="{{$item['image']}}" type="image/jpeg" medium="image" duration="4" height="{{$item['h']}}" width="{{$item['w']}}"/>
        </item>
        @endforeach

    </channel>
</rss>
