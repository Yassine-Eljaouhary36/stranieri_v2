<style> 
	.whatsapp-container{ 
	    width: 340px;
	    padding: 10px 0;
	    position: fixed;
	    right: 15px;
	    bottom: 10px;
	    margin: 0;
	    z-index: 1000;
	    text-align: right;
	    border-radius: 15px;
	}.whatsapp-widget-toggle-btn:hover{
		background: #22d307;
    	color: #ffffff;
        cursor: pointer;
	}
	.btn-send{  
	    background: #4fce5d; 
	}.whatsapp-content{
		background: #fefefe;
		border-radius: 15px;  
		text-align: left;
		box-shadow:0 0 7px 2px #001c4433;
	}.whatsapp-header{ 
		background: #036937;
		color: white;
		border-radius: 15px 10px 0 0;
		padding: 10px;
		display: flex;
    	align-items: center;
	}.whatsapp-header .fa{ 
		color: #8bc34a;
    	font-size: 46px ;
	}.whatsapp-header .whatsapp-slogan{ 
		color: #8bc34a !important;
    	font-size: 46px !important;
        padding: 5px 15px
	}.whatsapp-header .whatsapp-title{ 
        padding: 5px 15px
	}.whatsapp-header .whatsapp-agent-name{ 
		font-size: 20px; 
		color:#f4f4f4;
	}.whatsapp-header .whatsapp-division{ 
		font-size: 14px; 
		color:#fde1c59c;
	}.whatsapp-greeting{ 
		background: #d1ecd4;
		padding: 15px;
	}.whatsapp-greeting-msg{
		padding: 10px;
		background: white; 
		border-radius:0 13px 13px 13px;
		margin: 0 2rem .5rem 0;
		color: #6f6c6c;
	}.whatsapp-forms{
		padding: 15px;
	}.whatsapp-message{  
	  height:200px; 
	  min-height:60px;  
	  max-height:60px;
	}.whatsapp-forms-inputs{
		margin-bottom: 8px; 
	    font-size: 13px; 
	    color: #495057; 
	    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	}.whatsapp-form-check-input {
	    position: absolute;
	    margin-top: -11px;
	    margin-left: -1.25rem; 
	}.whatsapp-widget-toggle-btn{
		padding: 9px !important; 
	    font-size: 30px;
	    width: 44px;
	    height: 44px;
	    color: #22d307;
	    border-radius: 9rem;
	    display: inline-flex;
	    align-items: center;
	    cursor: default;
	    position: relative;
	    box-shadow: 0 0 10px 5px rgba(0,0,0,.1);
        margin: 1rem;
        background: white;
        position: fixed;
        bottom: 55px;
        right: 5px;
        z-index: -1;
	}.whatsapp-form-group{
		    padding: 5px 25px;
	}
	.whatsapp-form-check-label{
		color: #495057;
    } 
    @media (max-width: 1000px) {
        .whatsapp-container{ 
            width: 92%;
        }
    }
    .x{
        color: #99d397 !important;
        font-size: 30px !important;
        position: absolute;
        right: 14px;
        top: 16px; 
		padding: 20px; 
    }
</style>


<div class="whatsapp-container"> 
<div class="whatsapp-content collapse" id="collapse-whatsapp-chat">
<div class="whatsapp-header">
	<div class="whatsapp-slogan">
	<i class="chat-icon fa fa-headset"></i>
</div>
<div class="whatsapp-title">
	  <span class="whatsapp-agent-name">{{App()->communication->agent_support}} </span>
	  <br> 
	  <span class="whatsapp-division">
		@lang('frontend.support_agent')
	 	</span>
    </div>
     
    <i data-toggle="collapse" href="#collapse-whatsapp-chat" role="button" aria-expanded="false" aria-controls="collapse-whatsapp-chat" class="fa fa-times x" id="close-whatsapp-chat"></i>
</div>
<div class="whatsapp-greeting">
	 <div class="whatsapp-greeting-msg">
	 	{{App()->communication->whatsapp_greeting_msg}}
	 </div>
</div>
<div class="whatsapp-forms">
<form method="get" action="https://wa.me/{{App()->communication->whatsapp}}" id="form-whatsapp" autocomplete="off" class="needs-validation" novalidate target="new" style="{{ app()->getLocale() == 'ar' ? "direction: rtl;" : "" }}">
<input type="text" id="name" placeholder="@lang('frontend.fullname')" class="form-control whatsapp-forms-inputs" required>
<input type="email" id="email" placeholder="@lang('register_login.Email_Address')" class="form-control whatsapp-forms-inputs" required>
<textarea  id="message" class="form-control whatsapp-message whatsapp-forms-inputs" placeholder="@lang('frontend.message')" required></textarea>

<textarea rows="5" name="text" id="text" class="form-control d-none" placeholder="messaggio"></textarea>

 <div class="form-group mb-1">
    <div class="form-check {{ app()->getLocale() == 'ar' ? "text-end" : "" }}">
        <input class="whatsapp-form-check-input" type="checkbox" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck" style="margin-right:20px">   {{ __('register_login.Confirm_Agree') }} 
            {{-- <a href="{{url('page/politica-sulla-riservatezza')}}"> @lang('frontend.privacy_policy')</a>  --}}
            <a href="{{ url('/page/termini-condizioni') }}" target="_blank"> @lang('frontend.terms_of_use')</a>
            {{-- <a href="{{ url('/page/termini-condizioni') }}" target="_blank">@lang('frontend.terms_of_use') --}}
        </label>
        <div class="invalid-feedback"> @lang('frontend.please_accept_terms') </div>
        </div>
    </div>
    <div class="mt-2" style="display: flex; align-items: center; justify-content: center">
        <button class="custom-button btn-send btn-block text-light font-weight-bold" style="font: caption;width: 100%">@lang('frontend.send')</button>   
    </div>
</form>
</div>
</div>
  
<a id="whatsapp" data-toggle="collapse" data-target="#collapse-whatsapp-chat" role="button" aria-expanded="false" aria-controls="collapse-whatsapp-chat" class="whatsapp-widget-toggle whatsapp-widget-toggle-btn"><i class="fab fa-whatsapp"></i></a>
 
</div>
  @push('scripts')
      <script>
            $(document).ready(function(){
                $("#whatsapp").click(function(){
                    $("#collapse-whatsapp-chat").toggleClass("collapse");
                });
                $("#close-whatsapp-chat").click(function(){
                    $("#collapse-whatsapp-chat").toggleClass("collapse");
                });
            });
      </script>
  @endpush
<script>

 var from = "@lang('frontend.msg_from') : stranierinromagna.it";
 var name = `--`;
 var email = `--`;
 var msg = `{{App()->communication->message}}`;
  
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
		  event.preventDefault();
		  event.stopPropagation(); 
        if (form.checkValidity() === false) { 
          event.preventDefault();
          event.stopPropagation(); 
        }

		if (form.checkValidity() === true) {

            if($('#name').val().length > 0){ name = $('#name').val();}  
            if($('#email').val().length > 0){ email = $('#email').val();}  
            if($('#message').val().length > 0){ msg = $('#message').val();}

            $('#text').html(
                '@lang("frontend.fullname")  : ' + name 
                + '&#10;'
                + '@lang("frontend.email"): ' + email
                + '&#10;'
                + '@lang("frontend.message"): ' + msg
                + '&#10;'
                + from ); 
                
			$( "#form-whatsapp" ).submit();
		}
		 
		form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


 
</script>