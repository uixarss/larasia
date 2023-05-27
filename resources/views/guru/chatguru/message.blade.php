<div class="message-wrapper">
    <ul class="messages  messages-img">
        @foreach($messages as $message)
        <li class="message clearfix">
            {{--if message from id is equal to auth id then it is sent by logged in user --}}
            <div class="{{ ($message->from == Auth::id()) ? 'item in item-visible' : 'item item-visible' }}">
                <div class="image">
                    <img src="{{($message->from == Auth::id()) ? asset('admin/assets/images/users/user7.jpg') : asset('admin/assets/images/users/user4.jpg') }}" alt="Nadia Ali">
                </div>
                <div class="text">
                    <div class="heading">
                        <!-- <a href="#">John Doe</a> -->
                        <span class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</span>

                    </div>
                    {{ $message->message }}
                </div>
            </div>
            <!-- <div class="{{ ($message->from == Auth::id()) ? 'item in item-visible' : 'item item-visible' }}">
                <p>{{ $message->message }}</p>
                <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
            </div> -->
        </li>
        @endforeach
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit" placeholder="Ketik pesan...">
</div>