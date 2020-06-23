<form id="saber-register-form" class="saber-form" method="POST">

  <input class="register-name" type="hidden" />

  <div class="saber-register-messages"></div>

  <div class="saber-form-group">
    <label>Email</label>
    <input class="form-control register-email" name="register-email" type="text" />
  </div>

  <div class="saber-form-group">
    <label>Username</label>
    <input class="form-control register-username" name="register-username" type="text" />
  </div>

  <button>Register</button>

</form>


<style>

.saber-form {
  margin: 1rem 0;
}
.saber-form-group {
  margin-bottom: 1rem;
}

.saber-form-group label {
  display: inline-block;
  margin-bottom: .5rem;
}

.saber-form-group .form-control {
  display: block;
  width: 100%;
  max-width: 450px;
  padding: .375rem .75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: .25rem;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.saber-form button {
  color: #fff;
  background-color: #1A7283;
  border-color: #1A7283;
  width: 100%;
  max-width: 450px;
  margin: 0.5rem 0;
}
.saber-form button:hover {
  background-color: #1A7283E6;
}

</style>
