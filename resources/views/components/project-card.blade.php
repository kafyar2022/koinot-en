@props(['project'])

<figure class="project-card">
  <figcaption class="project-card__title">{{ $project->title }}</figcaption>
  <img
    class="project-card__logo"
    src="{{ asset($project->logo) }}"
    width="165"
    height="112"
    alt="{{ $project->title }}">
  <a class="project-card__link" target="_blank" href="{{ $project->url }}">{{ $project->url }}</a>
</figure>
