@extends('layouts.app')
@section('content')
<div id="d1"></div>
@endsection



@section('scripts')
<script>
$(document).ready(function() {
////////////////
var str=parent.window.opener.editorData	
$('#d1').html(str);
//////////////
$("#b2").click(function(){
var sel=$('#t2').val();	
window.opener.$('#t1').val(sel);	
self.close(); 
})
///////
})
</script>
@endsection