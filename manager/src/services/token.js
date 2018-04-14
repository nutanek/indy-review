export function getToken() {
    let name = "indy_review_token"
    let re = new RegExp(name + "=([^;]+)")
    let value = re.exec(document.cookie)
    return (value != null) ? unescape(value[1]) : null
}