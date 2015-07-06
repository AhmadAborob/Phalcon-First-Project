{% extends "templates/base.volt" %}

{%block head%}
    {{this.assets.outputCss('additional')}}
{%endblock%}

{%block content%}
<form class="form-signin" method="post" action="{{url('doRegister')}}">
        <h2 class="form-signin-heading">Register</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
        <input type="password" name="confirm_password" id="inputPassword" class="form-control" placeholder="Confirm Password" >
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
        <input type="hidden" name="{{security.getTokenKey()}}" value="{{security.getToken()}}"/>
      </form>

{%endblock%}