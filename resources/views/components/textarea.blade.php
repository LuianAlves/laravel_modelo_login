<div class="col-{{ $col }} offset-{{ $set }}">
    <label class="text-muted fw-bold" for="{{$id}}">{{$label}}</label>
    <div class="input-group">
        <span class="input-group-text" id="{{$id}}"><i class="fa-regular fa-file-lines"></i></span>
        <textarea class="form-control form-control-sm" placeholder="{{$placeholder}}" name="{{$name}}"
                  id="{{$id}}" rows="{{$row}}"></textarea>
    </div>
</div>
