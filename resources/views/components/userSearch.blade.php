
<form method="get" action="{{route("userArticleSearch")}}">
    @method('put')
    <div class="input-group mb-3">
      <input type="text" class="from-control" placeholder="" name="query" aria-label="Example text with button addon" aria-describedby="button-addon1">
      <button class="btn btn-secondary" type="submit" id="button-addon1">Search</button>
    </div>
  </form>