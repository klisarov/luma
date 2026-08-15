self.addEventListener('install', () => {
    self.skipWaiting();
});

self.addEventListener('activate', event => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('push', event => {
    if (!event.data) {
        return;
    }

    let payload = {};

    try {
        payload = event.data.json();
    } catch (error) {
        payload = {
            title: 'Luma',
            body: event.data.text(),
        };
    }

    const title = payload.title ?? 'Luma';

    const options = {
        body: payload.body ?? '',
        icon: payload.icon ?? '/icons/icon-192.png',
        badge: payload.badge ?? '/icons/icon-192.png',
        image: payload.image ?? undefined,
        tag: payload.tag ?? undefined,
        renotify: payload.renotify ?? false,
        requireInteraction: payload.requireInteraction ?? false,
        vibrate: payload.vibrate ?? undefined,
        actions: payload.actions ?? [],
        data: payload.data ?? {
            url: '/dashboard',
        },
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});


self.addEventListener('notificationclick', event => {
    event.notification.close();

    const destination =
        event.notification.data?.url ??
        '/dashboard';

    event.waitUntil(
        clients.matchAll({
            type: 'window',
            includeUncontrolled: true,
        }).then(clientList => {

            for (const client of clientList) {
                if ('focus' in client) {
                    client.navigate(destination);
                    return client.focus();
                }
            }

            if ('openWindow' in clients) {
                return clients.openWindow(destination);
            }

            return null;
        })
    );
});