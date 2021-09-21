<div class="form-wrapper">
    <form class="form" name="comment_form">
        <div class="row">
            <div class="field-50">
                <div class="label">
                    <label for="email">Email*</label>
                </div>

                <div class="input">
                    <input type="email" name="email" id="comment-form-name">
                </div>
            </div>

            <div class="field-50">
                <div class="label">
                    <label for="name">Name*</label>
                </div>

                <div class="input">
                    <input type="name" name="name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="label">
                    <label for="content">Comment*</label>
                </div>

                <div class="textarea">
                    <textarea name="content"> </textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="field">
                <div class="label">

                </div>

                <div class="element">
                    <button type="submit">Submit</button>
                </div>

                <div id="errors-notification" class="errors">
                </div>

                <div id="success-notification" class="success">
                </div>

            </div>
        </div>
    </form>
</div>

<div class="comment-wrapper">

    <div class="all-comments" id="all-comments">

    </div>
</div>
