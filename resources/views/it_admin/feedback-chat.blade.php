@extends('it_admin.layouts.app')

@section('content')
    <style>
        .chat-image {
            max-width: 10px;
            /* Set your preferred maximum width */
            max-height: 10px;
            /* Set your preferred maximum height */
        }

        .custom-link {
            color: pink;
            /* Set the color to pink or any other color you prefer */
            text-decoration: underline;
            /* Add underlining to make it clear that it's a link */
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row mb-2">
                {{-- <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Feedback') }}</h1>
                </div><!-- /.col --> --}}
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Attach Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('chat.store', ['feedback' => $feedback->feedback_docnum]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                <input type="hidden" name="message_type" value="image">
                                <input type="hidden" name="message" value="image">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="theimage">Select Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="theimage"
                                                accept="image/*">
                                            <label class="custom-file-label" for="theimage">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Direct Chat -->
            <div class="row">
                <div class="col-md-12">
                    <!-- DIRECT CHAT PRIMARY -->
                    <div class="card card-primary card-outline direct-chat direct-chat-primary" style="height: 80vh;">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">
                                    {{ __('Feedback Number - ') . $feedback->feedback_docnum . ' - ' . $feedback->topic }}
                                </h3>
                                <h3 class="card-title">{{ $feedback->status }}</h3>
                                <h3 class="card-title">
                                    @unless ($feedback->status === 'Close')
                                        <form action="{{ route('feedback.close', ['feedback' => $feedback->feedback_docnum]) }}"
                                            method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Close Feedback</button>
                                        </form>
                                    @endunless
                                </h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="height: 100%;">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="height: 100%;">
                                @foreach ($chats as $chat)
                                    @if ($chat->user_id !== auth()->user()->id)
                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg row">
                                            <div class=" col-5">
                                                <div class="direct-chat-infos clearfix">
                                                    <span class="direct-chat-name float-left">{{ $chat->user->name }}</span>
                                                    <span
                                                        class="direct-chat-timestamp float-right">{{ $chat->created_at->format('j M g:i a') }}</span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="{{ asset('images/avatar.png') }}"
                                                    alt="Message User Image">
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                    @if ($chat->message_type === 'image')
                                                        <img src="{{ asset($chat->image_path) }}" alt="Image"
                                                            style="width: 50%; height: auto;">
                                                    @else
                                                        {!! str_replace('<a ', '<a class="custom-link" ', html_entity_decode($chat->message)) !!}
                                                        <!-- Use html_entity_decode to make links clickable -->
                                                    @endif
                                                </div>
                                                <!-- /.direct-chat-text -->
                                            </div>
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    @else
                                        <!-- Message to the right -->
                                        <div class="direct-chat-msg right offset-md-7 col-md-5">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right">{{ $chat->user->name }}</span>
                                                <span
                                                    class="direct-chat-timestamp float-left">{{ $chat->created_at->format('j M g:i a') }}</span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img" src="{{ asset('images/avatar.png') }}"
                                                alt="Message User Image">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                @if ($chat->message_type === 'image')
                                                    <img src="{{ asset($chat->image_path) }}" alt="Image"
                                                        style="width: 50%; height: auto;">
                                                @else
                                                    {!! str_replace('<a ', '<a class="custom-link" ', html_entity_decode($chat->message)) !!}
                                                    <!-- Use html_entity_decode to make links clickable -->
                                                @endif
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                    @endif
                                @endforeach
                            </div>
                            <!--/.direct-chat-messages-->
                            <!-- /.direct-chat-pane -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if ($feedback->status === 'Open')
                                <form action="{{ route('chat.store', ['feedback' => $feedback->feedback_docnum]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                    <input type="hidden" name="message_type" value="text">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                data-target="#exampleModal">
                                                Attach Image
                                            </button>
                                        </div>
                                        <input type="text" name="message" placeholder="Type Message..."
                                            class="form-control" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!--/.direct-chat -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
