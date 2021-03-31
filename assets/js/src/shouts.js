"use strict";


(() => {
    const shoutList = document.querySelector('#shouts ul.shouts');
    const textArea = document.querySelector('#shouts textarea#shout_area');
    const sendButton = document.querySelector('#shouts button#send_shout');

    const createShout = (name, time, text) => {
        let shout = document.createElement('li');
        shout.classList.add('shout');
        let author = document.createElement('span');
        author.classList.add('author');
        author.innerText = name;
        let date = document.createElement('time');
        date.classList.add('time');
        date.innerText = new Date(time).toLocaleString('en-GB');
        let body = document.createElement('p');
        body.classList.add('body');
        body.innerText = text;

        shout.append(author);
        shout.append(date);
        shout.append(body);

        return shout;
    }

    const fetchShouts = () => {
        fetch('/shouts')
            .then(data => data.json())
            .then(json => {
                if (json) {
                    shoutList.innerHTML = '';
                    json.forEach(s => shoutList.append(createShout(s.author_name, s.created_at, s.body)));
                    shoutList.scrollTop = shoutList.scrollHeight;
                }
            })
            .catch(console.error);
    }

    const sendShout = () => {
        fetch('/shouts', {
            method: 'post',
            body: JSON.stringify({
                body: textArea.value
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
            .then(() => {
                fetchShouts();
                textArea.value = '';
            })
            .catch(console.error)
    }

    // Fetch the first batch on load
    fetchShouts();

    // Shout creation
    sendButton.addEventListener('click', sendShout);

    // Shout polling
    setInterval(fetchShouts, 3000)

    // Quick send
    textArea.addEventListener('keyup', e => {
        if (e.key === 'Enter' && (e.getModifierState('Shift') || e.getModifierState('Control'))) {
            sendShout();
        }
    });
})();

