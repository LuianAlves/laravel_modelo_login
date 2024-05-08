<div class="col-{{ $col }} offset-{{ $set }}">
    <div class="form-group">
        <label class="text-muted fw-bold" for="{{$id}}">{{$label}}</label>
        <select class="form-control form-control-sm" name="{{ $name }}"  id="{{ $id }}">{{$slot}}</select>
    </div>
</div>
