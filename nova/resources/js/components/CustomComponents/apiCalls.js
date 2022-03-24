export const getResourceData = (uri, type) => {
    return new Promise((resolve, reject) => {
        Nova.request()[type](uri)
            .then(res => {
                resolve(res.data)
            })
            .catch(err => {
                console.log('Error get api', err)
                reject(err)
            })
    })
}
export const getNotifications = () => getResourceData('/notifications', 'get')
export const getNotificationsNotRead = () => getResourceData('/notifications/not-read', 'get')

export const deleteNotifications = (id) => getResourceData('/notifications/' + id, 'delete')