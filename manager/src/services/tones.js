// import axios from 'axios'

export async function getTone() {
    try {
        let response = await fetch(window.config.api + "tone");
        let data = await response.json();
        return data.tone;
    } catch (error) {
        console.error(error);
    }
}

export async function setTone(tone) {
    try {
        let response = await fetch(
            window.config.api + "tone", {

                method: "POST",
                headers: {
                    // 'Accept': 'application/json, text/plain, */*',
                    // 'Content-Type': 'application/json',
                    // 'X-WP-Nonce': '45991ae126'
                    // 'X-WP-Nonce': '17b1ffa1c9'
                },
                body: JSON.stringify({
                    tone: tone,
                    _nonce: '45991ae126'
                })
            }
        );
        let data = await response.json();
        return data;
    } catch (error) {
        console.error(error);
    }
}