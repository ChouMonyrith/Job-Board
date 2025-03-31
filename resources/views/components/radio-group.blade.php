<div>
    <label for="{{$name}}" class="mb-1 flex items-center">
        <input type="radio" name="{{$name}}" value="" @checked(!request('{{$name}}'))>
        <span class="ml-2">All</span>
    </label>
    @foreach ($optionWithLabels as $option)
        <label for="{{$name}}" class="mb-1 flex items-center">
            <input type="radio" name="{{$name}}" 
            value="{{$option}}" @checked('entry' === request('{{$name}}'))>
            <span class="ml-2">{{$option}}</span>
        </label>
    @endforeach
</div>