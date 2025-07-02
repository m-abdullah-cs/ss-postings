<div> 
    <div class="border rounded bg-light p-4 mb-4">  
        @foreach ($messages as $message) 
            @if ($message['sender'] != Auth::user()->name)
                <div class="my_msg">
                    @if ($message['sender_picture'])
                        {{-- Show profile picture --}}
                        <img src="{{ asset('storage/assets/profiles/' . $message['sender_picture']) }}"
                            alt=""
                            class="sender_picture rounded-circle">
                    @else
                        {{-- Show initials avatar --}}
                        <div class="sender_picture d-flex align-items-center justify-content-center rounded-circle bg-secondary text-white fw-bold">
                            {{ $message['sender_name'] }}
                        </div>
                    @endif
                    <div class="clearfix w-4/4" style="word-break: break-word;">
                        {{-- Display message --}}
                        {{-- Use inline-block to allow the alert to wrap text properly --}}
                        <div class="alert alert-secondary inline-block float-start rounded-lg d-flex gap-1">
                            <span>{!! $message['message'] !!}</span>
                        </div>
                    </div>
                </div>
            @else   
                <div class="my_msg">
                    <div class="clearfix w-4/4" style="word-break: break-word;">
                        <div class="alert alert-success inline-block float-end rounded-lg d-flex gap-1">
                            <span>{!! $message['message'] !!}</span>
                        </div>
                    </div> 
                    @if ($message['sender_picture'])
                        {{-- Show profile picture --}}
                        <img src="{{ asset('storage/assets/profiles/' . $message['sender_picture']) }}"
                            alt=""
                            class="sender_picture rounded-circle">
                    @else
                        {{-- Show initials avatar --}}
                        <div class="sender_picture d-flex align-items-center justify-content-center rounded-circle bg-success text-white fw-bold">
                            {{ $message['sender_name'] }}
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    

    <form wire:submit="sendMessage()" id="messageForm">
        <div class="mb-3">
            <label for="message_body" class="form-label">Add your comment</label>
            <!-- Hidden file input -->
            {{-- <input type="file" id="attachments" name="attachments[]" class="form-control d-none" multiple=""> --}}
            <input type="hidden" id="message_body" wire:model="message" name="body">

            <trix-editor input="message_body" class="trix-editor"></trix-editor>

        </div>

        <div class="w-100">
            <input type="submit" class="btn btn-primary" value="Create Message">
        </div>
    </form>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById('messageForm');

        form.addEventListener('submit', function () {
            const value = document.querySelector('#message_body').value;
            Livewire.find(form.closest('[wire\\:id]').getAttribute('wire:id')).set('message', value);
        });
    });
</script>