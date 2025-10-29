<div class="flex flex-col gap-2">
<label class="font-semibold text-md "for="{{ $placeholder }}">{{$labelOfInput}}</label>
<input type="text" name="{{$name}}" placeholder="{{$placeholder}}" class="text-sm p-2 border rounded-xl border-gray-300 w-full max-w-3xl" value="{{old('$name')}}">
</div>