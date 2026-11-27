async function reveal(selector, keyHex) {
    if (!/^[a-f0-9]{24}$/i.test(selector)) return;
    if (!/^[a-f0-9]{64}$/i.test(keyHex)) return;

    const element = document.getElementById(selector);

    if (!element || element.tagName !== "P") return;

    const ciphertext = element.getAttribute(`data-${selector}`);

    if (!ciphertext) return;
        const key = await crypto.subtle.importKey(
            "raw",
            Uint8Array.from(
                keyHex.match(/../g),
                byte => parseInt(byte, 16)
            ),
            "AES-GCM",
            false,
            ["decrypt"]
        );

        const data = Uint8Array.from(
            atob(ciphertext),
            char => char.charCodeAt(0)
        );

        const plaintext = await crypto.subtle.decrypt(
            {
                name: "AES-GCM",
                iv: data.slice(0, 12),
                tagLength: 128
            },
            key,
            data.slice(12)
        );

        element.textContent = new TextDecoder().decode(plaintext);
        element.hidden = false;
}

async function revealAll() {
    const entries = location.hash.slice(1).split(";");

    await Promise.all(entries.map(entry => {
        const [selector, key, ...rest] = entry.split(":");

        if (!selector || !key || rest.length) return;

        return reveal(selector, key);
    }));
}

revealAll();