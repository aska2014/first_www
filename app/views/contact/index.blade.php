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
        <div class="row">
            @foreach($branches as $branch)
            <div id="marker-div-{{ $branch->id }}" class="office_address col-sm-6 col-md-4 marker-divs">
                <div class="team_member"> <img src="images/empty_logo.png"  alt="logo">
                    <h5>{{ $branch->title }}</h5>
                    <small>{{ $branch->sub_title }}</small><br>
                    <address>
                        {{ $branch->address }}
                    </address>
                    <abbr title="Phone">P:</abbr> {{ $branch->mobile_no }}<br>
                    <abbr title="Phone">E:</abbr> <a href="mailto:{{ $branch->email }}">{{ $branch->email }}</a> </div>
            </div>
            @endforeach
            <div class="contact_form col-sm-6 col-md-8">
                <form name="contact_form" action="{{ URL::route('contact.submit') }}" id="contact_form" method="post">
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
                            <button type="submit" id="submit_btn" class="btn btn-primary">Submit Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@stop