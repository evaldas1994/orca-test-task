const URL = 'https://d824-87-247-64-63.ngrok.io/';
getAllComments();

function getAllComments() {
    let allComments = document.getElementById('all-comments');

    fetch(URL + "api/comment")
    .then((res) => res.json())
    .then((data) => {
        allComments.innerHTML = `<div class="comment-wrapper-title">
            <h3 id="count-of-root-comments">${data.data.length + ' Comments'}</h3>
        </div>`;

        document.getElementById('count-of-root-comments').innerText = data.data.length + ' Comments';
        for(let i = 0; i < data.data.length; i++) {

        allComments.innerHTML += `<div class="single-comment">
            <div class="root-comment">
                <div class="data">
                    <div class="data-left" onclick="getAnswers(${data.data[i]['id']})">
                        <p class="data-name">${data.data[i]['name']}</p>
                        <p class="data-date">${data.data[i]['created_at']}</p>
                    </div>

                    <div class="data-right" onclick="showForm(${data.data[i]['id']}, ${data.data[i]['post_id']})">
                        <p><i class="fas fa-redo"></i> Reply</p>
                    </div>
                </div>

                <div class="content" onclick="getAnswers(${data.data[i]['id']})">
                    <p>${data.data[i]['content']}</p>
                </div>
            </div>

            <div class="answers hidden" id="answers-${data.data[i]['id']}">
                <form class="form hidden" name="comment_form_${data.data[i]['id']}" id="answers-form-${data.data[i]['id']}">
                    <div class="row">
                        <div class="field">
                            <div class="label">
                                <label for="email">Email*</label>
                            </div>

                            <div class="input">
                                <input type="email" name="email">
                            </div>
                        </div>

                        <div class="field">
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

                        </div>
                    </div>
                </form>
            </div>
        </div>`;


        }

        // console.log(data.data);
    });
}

const commentForm = document.forms.comment_form;
commentForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const inputName = commentForm.elements['name'].value;
    const inputEmail = commentForm.elements['email'].value;
    const inputContent = commentForm.elements['content'].value;

    fetch(URL + "api/comment/store", {
        method: "POST",
        headers: { "Content-Type": "application/json" },

        body: JSON.stringify({
            post_id: 3,
            root_comment_id: null,
            email: inputEmail,
            name: inputName,
            content: inputContent
        })
    })
    .then((res) => res.json())
    .then((data) => {
        if(data["success"] !== undefined) {
            var element = document.getElementById('success-notification');
            element.innerHTML = '<p>' + data["success"] + '</p>';
            getAllComments();

            var element = document.getElementById('errors-notification');
            element.innerHTML = '';
        }

        if(data["errors"] !== undefined) {
            var element = document.getElementById('errors-notification');
            let i=0;
            while(data['errors'][Object.keys(data['errors'])[i]] !== undefined) {
                element.innerHTML += '<p>' + data['errors'][Object.keys(data['errors'])[i]] + '</p>';
                i++;
            }

            var element = document.getElementById('success-notification');
            element.innerHTML = '';
        }
    });
})

function getAnswers(id) {

    console.log(id);

    let answersElement = document.getElementById('answers-' + id);
    let answersFormElement = document.getElementById('answers-form-' + id);

    fetch(URL+"api/comment/getAnswersByCommentId/" + id)
    .then((res) => res.json())
    .then((data) => {

        for(let i = 0; i < data.data.length; i++) {

            answersElement.innerHTML += `<div class="root-comment">
                <div class="data">
                    <div class="data-left">
                        <p class="data-name">${data.data[i]['name']}</p>
                        <p class="data-date">${data.data[i]['created_at']}</p>
                    </div>

                    <div class="data-right">

                    </div>
                </div>

                <div class="content">
                    <p>${data.data[i]['content']}</p>
                </div>
            </div>`;
        }

        if (answersElement.classList.contains('hidden')) {
            answersElement.classList.remove("hidden");
        } else {
            answersElement.classList.add("hidden");
            answersFormElement.classList.add("hidden");
        }
    });
}

function showForm(id) {
    let answersElement = document.getElementById('answers-' + id);
    let answersFormElement = document.getElementById('answers-form-' + id);

    if (answersFormElement.classList.contains('hidden')) {
        answersElement.classList.remove("hidden");
        answersFormElement.classList.remove("hidden");
    } else {
        answersFormElement.classList.add("hidden");


        console.log(commentAnswerForm);
    }
    let formById = 'comment_form_' + id;
    const commentAnswerForm = document.forms[formById];
    commentAnswerForm.addEventListener("submit", (event) => {
            event.preventDefault();
            console.log(commentAnswerForm.elements['name'].value);
            console.log(commentAnswerForm.elements['email'].value);
            console.log(commentAnswerForm.elements['content'].value);
            const inputName = commentAnswerForm.elements['name'].value;
            const inputEmail = commentAnswerForm.elements['email'].value;
            const inputContent = commentAnswerForm.elements['content'].value;

            fetch(URL + "api/comment/store", {
                method: "POST",
                headers: { "Content-Type": "application/json" },

                body: JSON.stringify({
                    post_id: 1,
                    root_comment_id: id,
                    email: inputEmail,
                    name: inputName,
                    content: inputContent
                })
            })
            .then((res) => res.json())
            .then((data) => {
                if(data["success"] !== undefined) {
                    var element = document.getElementById('success-notification');
                    element.innerHTML = '<p>' + data["success"] + '</p>';
                    getAllComments();

                    var element = document.getElementById('errors-notification');
                    element.innerHTML = '';
                }

                if(data["errors"] !== undefined) {
                    var element = document.getElementById('errors-notification');
                    let i=0;
                    while(data['errors'][Object.keys(data['errors'])[i]] !== undefined) {
                        element.innerHTML += '<p>' + data['errors'][Object.keys(data['errors'])[i]] + '</p>';
                        i++;
                    }

                    var element = document.getElementById('success-notification');
                    element.innerHTML = '';
                }
            });
        })
}
