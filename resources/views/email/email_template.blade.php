<div>
    <h2>Report Message!</h2>
    <h3>Book Title:</h3>
    <ul style="text-transform: capitalize">
        <li>{{$data['title']}}</li>
    </ul>
</div>
<h3>Report details:</h3>
    <ul>
        <li><p>{{$data['report_message']}}</p></li>
    </ul>
<div>
    Book in web: <a href="http://127.0.0.1:8000/book/{{$data['book_url']}}" style="text-transform: capitalize">{{$data['title']}}</a>
</div>
<div style="margin-top: 15px;">
    Sender: {{Auth()->user()->email}}
</div>

