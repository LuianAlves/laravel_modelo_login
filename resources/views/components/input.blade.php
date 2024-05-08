<div class="col-{{ $col }} offset-{{ $set }}">
    <label class="text-muted fw-bold" for="{{$id}}">{{$label}}</label>
    <div class="input-group">
        <input type="{{ $type }}" class="form-control form-control-sm" id="{{ $id }}" name="{{ $name }}"
               placeholder="{{ $placeholder }}">
        <span class="input-group-text" id="{{$id}}"><i class="{{$icon}}"></i></span>
    </div>
</div>

<style>
    label {
        font-size: 13.5px;
        margin-bottom: 5px;
    }
</style>
