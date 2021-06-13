@props(['message', "type" => "primary"])
<div class="alert alert-{{ $type }} alert-dismissible fade show"
    style="position:fixed; top:13vh; left: 55vw; width: 40%;z-index: 10">
    <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
    <span>
        <b> {!! nl2br(e($message)) !!} </b>
    </span>
</div>
