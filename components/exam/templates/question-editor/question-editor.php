<div id="question-editor">

  <div class="saber-field">
    <label>Question Type</label>
    <select id="question_type" name="question_type">
      <option value='mc'>Multiple Choice</option>
      <option value="tf">True/False</option>
    </select>
  </div>

  <div class="saber-field">
    <label>Question Body</label>
    <textarea id="question_body" name="question_body"><?php print $question->body; ?></textarea>
  </div>

  <hr />

  <div class="saber-field question-options-field">
    <label>Question Options</label>
    <button id="question_option_add">+ Add Option</button>
    <ul id="question_options_editor"></ul>
    <input type="hidden" id="question_options" name="question_options" />
  </div>

</div>
