<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add another email input</title>
    <style>
      .input-plus {
        display: flex;
      }

      .inputs-set {
        border: none;
      }

      .input-field {
        border: none;
        border: 1px solid rgb(209, 209, 209);
        padding: 8px;
        margin-right: 4px;
        margin-bottom: 4px;
        display: block;
      }

      .btn-submit,
      .btn-add-input {
        border: none;
        padding: 8px 12px;
      }

      .btn-submit {
        background-color: rgb(152, 247, 199);
      }

      .btn-add-input {
        background-color: rgb(127, 187, 255);
      }
    </style>
  </head>
  <body>
    <form id="form" action="" method="POST">
      <fieldset class="inputs-set" id="email-list" class="input-field">
        <input class="input-field" type="email" name="email_field[]" required />
      </fieldset>
      <button class="btn-submit" type="submit">SUBMIT</button>
    </form>
    <button class="btn-add-input" onclick="addEmailField()" type="">
      Add email
    </button>

    <script>
      const myForm = document.getElementById("email-list");

      function addEmailField() {
        // create an input field to insert
        const newEmailField = document.createElement("input");
        // set input field data type to text
        newEmailField.type = "email";
        // set input field name
        newEmailField.name = "email_field";
        // set required
        newEmailField.setAttribute("required", "");

        newEmailField.classList.add("input-field");

        // insert element
        myForm.appendChild(newEmailField);
      }
    </script>
  </body>
</html>
