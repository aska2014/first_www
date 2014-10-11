@extends('index')

@section('content')
<div class="container triangles-of-section">
    <div class="triangle-up-left"></div>
    <div class="square-left"></div>
    <div class="triangle-up-right"></div>
    <div class="square-right"></div>
</div>
<div class="container">
    <section>
        @foreach($branches as $branch)
        <div class="row marker-divs" id="marker-div-{{ $branch->id }}">
            <div class="office_address col-sm-6 col-md-4">
                <div class="team_member"> <img src="images/empty_logo.png"  alt="logo">
                    <h5>{{ $branch->title }}</h5>
                    <small>{{ $branch->sub_title }}</small><br>
                    <address>
                        {{ $branch->address }}
                    </address>
                    <abbr title="Phone">P:</abbr> {{ $branch->mobile_no }}<br>
                    <abbr title="Phone">E:</abbr> <a href="mailto:{{ $branch->email }}">{{ $branch->email }}</a> </div>
            </div>
            <div class="contact_form col-sm-6 col-md-8">
                <form name="contact_form" id="contact_form" method="post">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <label>Name</label>
                            <input name="name" id="name" class="form-control" type="text" value="">
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <label>E-mail</label>
                            <input name="email" id="email" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <label>Subject</label>
                            <input name="subject" id="subject" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <label>Message</label>
                            <textarea name="message" id="message" rows="8" class="form-control"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12"><br/>
                            <a id="submit_btn" class="btn btn-primary" name="submit">Submit Message</a> <span id="notice" class="alert alert-warning alert-dismissable hidden" style="margin-left:20px;"></span> </div>
                    </div>
                    <input type="hidden" name="to_email" value="{{ $branch->email }}"/>
                </form>
            </div>
        </div>
        @endforeach
    </section>
</div>
@stop