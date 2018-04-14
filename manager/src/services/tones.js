import axios from 'axios'
import { getToken } from './token'

export async function getTone() {
    try {
        let res = await axios.get(window.config.api + "tone")
        return res.data.tone
    } catch (error) {
        console.error(error)
    }
}

export async function setTone(tone) {
    try {
        let res = await axios.post(
            window.config.api + "tone", {
                jwt: getToken(),
                tone: tone,
            }
        );
        return res.data
    } catch (error) {
        throw error
    }
}