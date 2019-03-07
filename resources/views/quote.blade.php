@extends('default')

<!-- Stones Main Content -->
@section('content')
    <!-- Quote -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <a href="/home"><i class="fa fa-home"></i>&nbsp;Home</a>
                        <span class="crumbs-spacer"><i class="fa fa-angle-double-right"></i></span>
                        <span class="current">Quote</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="content" style=" background-image: url(data/bg.jpg); background-position: center;    background-size: cover;background-repeat: no-repeat;">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-center" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;justify-content: center!important;">
                        <div class=" col-sm-8 col-md-6 py-3">
                            <div class="card card-outline-secondary" style="background: #fff; padding:10px 40px;">
                                <div class="card-body">
                                    <h3 class="text-center">Request a Free Quote</h3>
                                    <hr>
                                    <form autocomplete="off" id="quote" class="form" role="form" name="upload" action="connect.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="inputName">Your Name*</label>
                                            <input class="form-control" id="inputName" name="name" required="required" title="Your name" type="text" placeholder="Your name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Email*</label>
                                            <input class="form-control" id="inputEmail" name="email" placeholder="Email" required="required" type="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Phone</label>
                                            <input autocomplete="off" id="phone" class="form-control" name="phone" maxlength="20"  required="required" title="Phone number" type="text" placeholder="Your Phone">
                                        </div>
                                        <div class="form-group" >
                                            <label for="exampleMessage">File Uploads</label>
                                            <div style="border:1px solid #e1e1e1; border-radius: 0 5px 5px 0;">
                                                <div class="form-group1">
                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="uploadFile" type="file" class="file-upload-field" id="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleMessage">Message</label>
                                            <textarea class="form-control" name="message" id="message" rows="6" required="required"></textarea>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success btn-lg btn-block" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                </div>
                            </div><!-- /form card cc payment -->
                        </div>
                    </div>
                </div><!--/col-->
            </div><!--/row-->
        </div><!--/container-->
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
@endsection
