import axios from 'axios'
export default class UrlShortenService {
    static shortenUrl = (data) =>
        axios.post(`/api/shorten`, {url: data}, { excludeLoader: true })
}
