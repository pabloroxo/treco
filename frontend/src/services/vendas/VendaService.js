import axios from 'axios'

const url = import.meta.env.VITE_API_URL + '/vendas/'

export default {
    get(id, filtro) {
        if (id) {
            return axios.get(
                url + id,
            )
        }
console.log (filtro)
        return axios.get(
            url,
            { params: filtro }
        );
    },

    post(data) {
        return axios.post(
            url,
            data,
        );
    },

    put(id, data) {
        return axios.put(
            url + id,
            data,
        );
    },

    delete(id) {
        return axios.delete(
            url + id,
        )
    }
}