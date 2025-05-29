import axios from 'axios'

const url = import.meta.env.VITE_API_URL + '/vendedores/'

export default {
    get(id) {
        if (id) {
            return axios.get(
                url + id,
            )
        }

        return axios.get(
            url,
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