const resource = 'send_mail.php'

confirmButton.addEventListener('click', () => {
  let objectives = []

  Array.from(document.getElementsByClassName('objective')).forEach(objective => {
    if (objective.checked) objectives.push(objective.value)
  })

  formData = new FormData(form)
  formData.append('confirmFlag', true)

  fetch(resource, {method: 'POST', body: formData})
  .then(response => response.text())
  .then(text => {
    let json = JSON.parse(text)

    if (json['err_msgs']) alert(json['err_msgs'])
    else {
      let file = document.querySelector('#attachment').files[0] ?? ''

      confirmName.innerHTML = h(lastName.value + ' ' + firstName.value)
      confirmRuby.innerHTML = h(lastNameRuby.value + ' ' + firstNameRuby.value)
      confirmJob.innerHTML = h(job.value)
      confirmPostalCode.innerHTML = h(postalCode.value)
      confirmStreetAddress.innerHTML = h(streetAddress.value)
      confirmTel.innerHTML = h(tel.value)
      confirmEmail.innerHTML = h(email.value)
      confirmObjective.innerHTML = objectives.map(objective => h(objective)).join('<br>')
      confirmAttachment.innerHTML = h(file.name ?? '')
      confirmDesiredDate.innerHTML = h(desiredDate.value)
      confirmInquiry.innerHTML = h(inquiry.value)
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

  fetch(resource, {method: 'POST', body: formData})
  .then(response => response.text())
  .then(text => {
    confirmModal.classList.remove('modal-show')
    completeModal.classList.add('modal-show')
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

const h = str => {
  if (!str) return ''
  return str.replace(/[<>&"'`]/g, match => {
    const escape = {
      '<': '&lt;',
      '>': '&gt;',
      '&': '&amp;',
      '"': '&quot;',
      "'": '&#39;',
      '`': '&#x60;'
    }
    return escape[match]
  })
}
