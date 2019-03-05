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
                                    <form autocomplete="off" class="form" role="form" name="upload" action="connect.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="inputName">Your Name*</label>
                                            <input class="form-control" id="inputName"  required="required" title="Your name" type="text" placeholder="Your name">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Email*</label>
                                            <input class="form-control" id="inputEmail" placeholder="Email" required="" type="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Phone</label>
                                            <input autocomplete="off" class="form-control" maxlength="20"  required="" title="Phone number" type="text" placeholder="Your Phone">
                                        </div>
                                        <div class="form-group" >
                                            <label for="exampleMessage">File Uploads</label>
                                            <div style="border:1px solid #e1e1e1; border-radius: 0 5px 5px 0;">
                                                <div class="form-group1">
                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleMessage">Message</label>
                                            <textarea class="form-control" id="complexExampleMessage" rows="6"></textarea>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button class="btn btn-success btn-lg btn-block" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /form card cc payment -->
                        </div>
                    </div>
                </div><!--/col-->
            </div><!--/row-->
        </div><!--/container-->
    </section>

@endsection
