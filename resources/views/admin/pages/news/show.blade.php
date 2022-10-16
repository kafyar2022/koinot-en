@extends('admin.layouts.master')

@section('content')
  <main class="page__content">
    <div class="modal modal--fail {{ session()->has('fail') ? '' : 'modal--hidden' }}">{{ session()->get('fail') }}</div>
    <div class="modal modal--success {{ session()->has('success') ? '' : 'modal--hidden' }}">{{ session()->get('success') }}</div>

    <ul class="page__breadcrumbs">
      <li class="page__breadcrumb">
        <a href="{{ route('main') }}">Главная =></a>
      </li>
      <li class="page__breadcrumb">
        <a href="{{ route('admin.news') }}">Новости =></a>
      </li>
      <li class="page__breadcrumb page__breadcrumb--current">
        {{ $data->news ? 'Редактирование' : 'Добавление' }}
      </li>
    </ul>

    <div class="page__link-wrapper">
      @if ($data->news)
        <h1 class="page__title">Редактирование</h1>
      @else
        <h1 class="page__title">Добавление</h1>
      @endif
      <a class="page__link" data-action="submit">Сохранить</a>
    </div>

    <form class="form-dash" action="{{ $data->news ? route('news.post', ['action' => 'update']) : route('news.post', ['action' => 'store']) }}" method="post" enctype="multipart/form-data">
      @csrf

      @if ($data->news)
        <input type="hidden" name="id" value="{{ $data->news->id }}">
      @endif

      <label class="form-dash__element" style="grid-column: span 3;">
        <span class="form-dash__label">Заголовок*</span>
        <input class="form-dash__field" name="title" type="text" value="{{ $data->news->title ?? '' }}" required data-pristine-required-message="Объязательное поле">
      </label>

      <label class="form-dash__element" style="grid-column: span 3;">
        <span class="form-dash__label">Новость</span>
        <textarea class="form-dash__field" name="content">{{ $data->news->content ?? '' }}</textarea>
      </label>

      <label class="form-dash__element" style="grid-column: 4/5; grid-row: 1/2">
        <span class="form-dash__label">Дата</span>
        <input
          class="form-dash__field"
          name="date"
          type="datetime-local"
          value="{{ $data->news->date ?? '' }}">
      </label>

      <div class="form-dash__element" style="grid-column: 4/5; grid-row: 2/6;">
        <span class="form-dash__label">Картинки</span>
        <label class="form-dash__upload-images">
          Загрузить фотки
          <input class="visually-hidden" name="images[]" type="file" accept=".png, .jpeg, .jpg" multiple>
        </label>
        <div class="form-dash__images">
          @if ($data->news)
            @foreach ($data->news->images as $image)
              <div data-img="{{ $image->id }}">
                <img src={{ asset($image->src) }} width="70" height="70">
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </form>
  </main>
@endsection

@section('script')
  <script src="{{ asset('js/dashboard/pages/news/show.js') }}" type="module"></script>
@endsection
