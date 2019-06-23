$(document).off('.data-api')
$('.btn.danger').button('toggle').addClass('fat')
$('#myModal').modal()                      // initialized with defaults
$('#myModal').modal({ keyboard: false })   // initialized with no keyboard
$('#myModal').modal('show')                // initializes and invokes show immediately

$.fn.modal.Constructor.DEFAULTS.keyboard = false // changes default for the modal plugin's `keyboard` option to false

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})