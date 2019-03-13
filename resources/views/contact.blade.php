@extends('default')

<!-- Stones Main Content -->
@section('content')
    <!-- Contact -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/home"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Contact Us</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="content">
        <div class="contact-info">
            <div class="container">
                <div class="col-md-12">
                    <div class="header-wrap text-center">
                        <h3>Send us a message</h3>
                        <p class="description">We would like to hear from you</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form id="form" class="contact-form" method="POST" autocomplete="on">
                            <div class="row">
                                <div class="col-md-6  col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required="required" data-error="Please enter your name">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="JohnDoe@email.com" required="required" data-error="Please enter your email">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subject</label>
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Hello" required="required" data-error="Please enter your subject">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea class="form-control" id="message"  name="message" style="height: 130px;" placeholder="" cols="10" rows="11" maxlength="5000" data-error="Write your message" required="required"></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12  col-sm-12  col-xs-12">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6">

                                                </div>
                                                <div class="col-xs-12 col-sm-6">
                                                    <button type="submit" id="submit" class="btn btn-common disabled" style="pointer-events: all; cursor: pointer;">Send Message</button>
                                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- Contact Info Section -->
                @if(isset($sections) && array_key_exists('urban-contactus-info-tabs', $sections))
                    @php $contactSection = $sections['urban-contactus-info-tabs'] ?? "" @endphp
                    <div class="row">
                        <div class="contact-info-wrapper clearfix">
                            @if (isset($contactSection['posts']))
                                @php $contacts = $contactSection['posts'] @endphp
                                @foreach ($contacts as $contact)
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="contact-item-wrapper clearfix">
                                            <div class="col-xs-2 col-sm-4">
                                                <div class="row">
                                                    <img src="{{asset($contact['image'] ?? "")}}"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-10 col-sm-8">
                                                <ul>
                                                    <li>{{$contact['title'] ?? ""}}</li>
                                                    <li>{{$contact['content'] ?? ""}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <div id="myModal" class="modal fade"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thank you</h4>
                </div>
                <div class="modal-body">
                    <p>Your message was successfully sent , We will get back to you very soon, if you need to browse our site just click the link below.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" style="color:whitesmoke!important; background-color: #087071 !important;">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="map" style="margin-bottom:-5px;">
        <iframe class="map-black-white" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4420.738071086475!2d-87.7133652525986!3d41.8262797209695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880e321a2d6f89ad%3A0x4c1da36516ec232!2s3734+S+St+Louis+Ave%2C+Chicago%2C+IL+60632!5e0!3m2!1sen!2sus!4v1465681550370" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

@endsection
