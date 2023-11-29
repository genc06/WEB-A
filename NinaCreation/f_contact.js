
function gtag() {
    dataLayer.push(arguments);
}


test('gtag pushes arguments to dataLayer', () => {
    // Arrange
    const originalDataLayer = dataLayer.slice(); // enregistre l'etat de base
    

    // Act
    gtag('event', 'some_event', { key: 'value' });

    // Assert
    expect(dataLayer).toHaveLength(originalDataLayer.length + 1); // Check if dataLayer has one more item
    expect(dataLayer[dataLayer.length - 1]).toEqual(['event', 'some_event', { key: 'value' }]); // Check if the last item is the expected array
});