@extends('layouts.main-layout')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto my-5">
            <h1 class="text-center" style="font-family: 'great vibes'; font-size: 65px;">Contatti</h1>

        </div>
    </div>
    <div class="row">
        <div class="col-8 mx-auto text-center contact-form">
            
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form method="post">
               
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="number" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="button button1 mt-3 bottoneContact" value="Send Message" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea type="text" name="txtMsg" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>

        </div>
   </div>
</div>

@endsection
