<x-layouts.app>

  <x-slot name="title" >{{ $title ?: __('Default') }}</x-slot>

  <x-partials.breadcrumb :heading="$title" :breadcrumbs="[['title' => 'Tickets', 'route' => 'tickets.customer'], ['title' => 'Messages']]" />

  <section class="row" >
    <div class="col-xl-4 d-none d-xl-inline" >
      <div class="card bg-white border-0 rounded-0 shadow" >
        <div class="card-header bg-white pb-0" >
          <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-title" >{{ __('Ticket Details') }}</h6>
            <span class="badge bg-{{ $ticket->status === 'open' ? 'warning' : 'danger' }}" >{{ ucfirst($ticket->status) }}</span>
          </div>
        </div>
        <div class="card-body" >
          <div class="row g-3">
            <div class="col-sm-12">
              <p class="py-0 my-0" >
                <strong>{{ __('Opened By :') }}</strong>
                <span>{{ $ticket->customer->name }}</span>
              </p>
            </div>
            <div class="col-sm-12">
              <p class="py-0 my-0" >
                <strong>{{ __('Responsed By :') }}</strong>
                <span>{{ $ticket->admin->name }}</span>
              </p>
            </div>
            <div class="col-sm-12">
              <p class="py-0 my-0" >
                <strong>{{ __('Opened at :') }}</strong>
                <span>{{ $ticket->created_at->format('d-m-Y H:i:s A') }}</span>
              </p>
            </div>
            <div class="col-sm-12">
              <label>
                <strong>{{ __('Title') }}</strong>
              </label>
              <p class="py-0 my-0" >{{ $ticket->title }}</p>
            </div>
            <div class="col-sm-12">
              <label>
                <strong>{{ __('Description') }}</strong>
              </label>
              <p class="py-0 my-0" >{{ $ticket->description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8" >
      <div class="card bg-white border-0 rounded-0 shadow" >
        <div class="card-header bg-white pb-0" >
          <h6 class="card-title" >{{ __('Compose Message') }}</h6>
        </div>
        <div class="card-body" id="messagesContainer" style="height: 300px; overflow-y: auto;" ></div>
        <div class="card-footer bg-white" >
          @if ($ticket->status === 'close')
            <p>{{ __('You are no longer able to reply this conversation.') }}</p>
          @else
            <form id="sendMessage" method="POST" enctype="multipart/form-data" >
              @csrf
              <input type="hidden" name="ticket_id" id="ticketId" value="{{ $ticket->id }}" />
              <textarea name="content" class="form-control form-control-sm resize-none mb-2" id="message" cols="30" rows="2" placeholder="Type your message here ... "></textarea>
              <button type="submit" class="btn btn-sm btn-secondary px-4" id="send" >
                <i class="fas fa-paper-plane"></i>
                <strong class="ms-1">{{ __('Submit') }}</strong>
              </button>
            </form>
          @endif
        </div>
      </div>
    </div>
  </section>

  <x-slot name="scripts" >
    <script src="{{ asset('plugins/axios.min.js') }}" ></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const messagesContainer = document.getElementById('messagesContainer');
        const sendMessageForm = document.getElementById('sendMessage');
        const ticketId = document.getElementById('ticketId').value;
        const sendRoute = '{{ route('messages.send') }}';

        function fetchMessages() {
          axios.get(`/messages/fetch/${ticketId}`).then(function (response) {
            messagesContainer.innerHTML = '';
            response.data.messages.forEach(function (message) {
              const messageElement = document.createElement('div');
              messageElement.classList.add('message');
              const createdAt = new Date(message.created_at);
              const formattedCreatedAt = createdAt.toLocaleString('en-US', {
                month: 'long',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
              });

              let messageHtml = '';

              if (message.user_id === {{ auth()->user()->id }}) {
                messageHtml = `
                <div class="row mt-2 mb-3">
                  <div class="col-9 offset-3 text-end">
                    <p class="bg-primary text-white rounded-pill px-3 py-1 my-0">${message.content}</p>
                    <small class="delivered py-0 mx-3 my-0">${formattedCreatedAt}</small>
                  </div>
                </div>`;
              } else {
                messageHtml = `
                <div class="row mt-2 mb-3">
                  <div class="col-9">
                    <p class="bg-light rounded-pill px-3 py-1 my-0">${message.content}</p>
                    <small class="delivered py-0 mx-3 my-0">${formattedCreatedAt}</small>
                  </div>
                </div>`;
              }
              messageElement.innerHTML = messageHtml;
              messagesContainer.appendChild(messageElement);
              messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });
          }).catch(function (error) {
            console.error(error);
          });
        }

        setInterval(fetchMessages, 500);

        sendMessageForm.addEventListener('submit', function (event) {
          event.preventDefault();
          const messageContent = document.getElementById('message').value;

          if (!messageContent) {
            alert('Please enter a message.');
            return;
          }

          axios.post(sendRoute, {
            ticket_id: ticketId,
            content: messageContent
          }, {
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
          }).then(function (response) {
            console.log(response.data);
            document.getElementById('content').value = '';
            fetchMessages();
          }).catch(function (error) {
            console.error(error.response.data);
            alert('There was an error submitting the form. Please try again.');
          });
        });
      });
    </script>
  </x-slot>

</x-layouts.app>
