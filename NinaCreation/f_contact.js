
function gtag() {
    dataLayer.push(arguments);
}


test('gtag pushes arguments to dataLayer', () => {

    const originalDataLayer = dataLayer.slice(); // enregistre l'etat de base

    gtag('event', 'some_event', { key: 'value' });

    expect(dataLayer).toHaveLength(originalDataLayer.length + 1);
    expect(dataLayer[dataLayer.length - 1]).toEqual(['event', 'some_event', { key: 'value' }]); // Verifie l'etat attendu du item
});