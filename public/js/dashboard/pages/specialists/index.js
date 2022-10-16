document.addEventListener('click', (evt) => {
  if (evt.target.dataset.action === 'delete') {
    evt.target.closest('tr')
      .innerHTML = `
      <td colspan="4">Вы уверены что хотите удалить этого специалиста?</td>
      <td><a data-action="cancel">Отмена</a></td>
      <td><a href="/dashboard/specialists/delete/${evt.target.dataset.id}">Удалить</a></td>
    `;
  }
  if (evt.target.dataset.action === 'cancel') {
    location.reload();
  }
});
