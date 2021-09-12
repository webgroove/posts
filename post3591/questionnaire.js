const request = 'questionnaire.php'

confirmButton.addEventListener('click', () => {
  formData = new FormData(form)
  formData.append('confirmFlag', true)

  fetch(request, {method: 'POST', body: formData})
  .then(response => response.json())
  .then(json => {
    let errMsg = json['err_msg']

    if (errMsg) alert(errMsg)
    else {
      confirmEmail.innerHTML = json['email']
      confirmMessage.innerHTML = json['message']
      csrfToken.value = json['csrf_token']

      confirmModal.classList.add('modal-show')
      overlay.classList.add('overlay-show')
    }
  })
})

sendButton.addEventListener('click', () => {
  formData = new FormData()
  formData.append('sendFlag', true)
  formData.append('csrfToken', csrfToken.value)

  fetch(request, {method: 'POST', body: formData})
  .then(response => response.json())
  .then(json => {
    let errMsg = json['err_msg']

    confirmModal.classList.remove('modal-show')

    if (errMsg) {
      alert(errMsg)
      overlay.classList.remove('overlay-show')
    } else completeModal.classList.add('modal-show')
  })
})

completeButton.addEventListener('click', () => {
  completeModal.classList.remove('modal-show')
  overlay.classList.remove('overlay-show')
})

backButton.addEventListener('click', () => {
  confirmModal.classList.remove('modal-show')
  overlay.classList.remove('overlay-show')
})
