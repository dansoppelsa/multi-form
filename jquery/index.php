<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form - jQuery</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="flex items-center justify-center" id="form-app">
    <form class="w-full max-w-lg border border-gray-300 rounded p-4 m-4">
        <div class="font-bold text-xl mb-3 pb-2 border-b border-gray-300 uppercase">Contact Us</div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    First Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="first-name" type="text" placeholder="Jane">
                <p style="display: none;" id="first-name-error" class="text-red-500 text-xs italic mt-2"></p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                    Last Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" placeholder="Doe">
                <p style="display: none;" id="last-name-error" class="text-red-500 text-xs italic mt-2"></p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    E-mail
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email">
                <p style="display: none;" id="email-error" class="text-red-500 text-xs italic mt-2"></p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Message
                </label>
                <textarea class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none" id="message"></textarea>
                <p style="display: none;" id="message-error" class="text-red-500 text-xs italic mt-2"></p>
                <p class="text-gray-400">Message Length: <span id="message-length"></span></p>
            </div>
        </div>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3">
                <button id="submit-button" class="shadow bg-purple-500 hover:bg-purple-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                    Send
                </button>

                <button id="clear-button" class="shadow bg-gray-500 hover:bg-gray-600 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
                    Clear
                </button>
            </div>
            <div class="md:w-2/3"></div>
        </div>
    </form>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>

<script>
  let form, errors = []

  let updateMessageLength = () => {
    $('#message-length').text(form.message.val().length)
  }

  $(document).ready(() => {
    form = {
      'first-name': $('#first-name'),
      'last-name': $('#last-name'),
      'email': $('#email'),
      'message': $('#message'),
    }

    $('#submit-button').click((e) => {
      errors = []

      Object.keys(form).forEach(key => {
        let value = form[key].val().trim(),
          element = $(`#${key}-error`)

        if (value === '') {
          let message = `The ${key.replace('-', ' ')} field is required`
          errors.push(message)
          element.text(message).show()

          return null;
        }

        element.text(``).hide()
      })

      if (errors.length) {
        return
      }

      $('#form-app form').hide()
      $('#form-app').append(`<h1 class="font-bold text-3xl mt-20 text-center text-purple-700">Thank you for your submission ${form['first-name'].val()}!</h1>`)
    })

    $('#clear-button').click((e) => {
      Object.keys(form).forEach(key => {
        form[key].val('')

        $(`#${key}-error`).text(``)
        $(`#${key}-error`).hide()
      })

      updateMessageLength()
    })

    form.message.on('input', (e) => {
      updateMessageLength()
    })
  });

</script>
</body>
</html>