@extends('admin.layouts.master')

@section('content')
  <main class="page__content">
    <div class="modal modal--fail {{ session()->has('fail') ? '' : 'modal--hidden' }}">{{ session()->get('fail') }}</div>
    <div class="modal modal--success {{ session()->has('success') ? '' : 'modal--hidden' }}">{{ session()->get('success') }}</div>

    <ul class="page__breadcrumbs">
      <li class="page__breadcrumb">
        <a href="{{ route('main') }}">Главная =></a>
      </li>
      <li class="page__breadcrumb page__breadcrumb--current">История компании</li>
    </ul>

    <div class="page__link-wrapper" style="padding: 0 2px">
      <h1 class="page__title">История компании</h1>
      <a class="page__link" href="{{ route('admin.histories', ['action' => 'create']) }}">
        Добавить
      </a>
    </div>

    @if (count($data->histories) != 0)
      <table class="page__table">
        <thead>
          <tr>
            <th>№</th>
            <th>Годы</th>
            <th>История</th>
            <th colspan="2">Действия</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($data->histories as $key => $history)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>
                <div style="min-width: max-content;">{{ $history->years }}</div>
              </td>
              <td>
                <div>{{ $history->history }}</div>
              </td>
              <td>
                <a href="{{ route('admin.histories', ['action' => 'edit', 'history' => $history->id]) }}">Редактировать</a>
              </td>
              <td>
                <a data-action="delete" data-id="{{ $history->id }}">Удалить</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <p>Нет данных</p>
    @endif

  </main>
@endsection

@section('script')
  <script src="{{ asset('js/dashboard/pages/histories/index.js') }}" type="module"></script>
@endsection
