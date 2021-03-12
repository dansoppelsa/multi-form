describe('The contact form test', () => {
  beforeEach(() => {
    cy.visit(Cypress.env('FORM_URL'))
  })

  it('Can display the contact form', () => {
    cy.get('body').contains('Contact Us').should('be.visible')
  })

  it('Displays an error message if the first name is not completed and submission is attempted', () => {
    cy.get('#last-name')
      .type('Loblaw')
      .get('#email')
      .type('b.loblaw@example.com')
      .get('#message')
      .type('The duck flies at midnight')

    cy.get('#submit-button')
      .click()

    cy.get('body')
      .should('contain', 'The first name field is required')
      .should('not.contain', 'The last name field is required')
      .should('not.contain', 'The email field is required')
      .should('not.contain', 'The message field is required')
  })

  it('Displays an error message if the last name is not completed and submission is attempted', () => {
    cy.get('#first-name')
      .type('Bob')
      .get('#email')
      .type('b.loblaw@example.com')
      .get('#message')
      .type('The duck flies at midnight')

    cy.get('#submit-button')
      .click()

    cy.get('body')
      .should('not.contain', 'The first name field is required')
      .should('contain', 'The last name field is required')
      .should('not.contain', 'The email field is required')
      .should('not.contain', 'The message field is required')
  })

  it('Displays an error message if the email is not completed and submission is attempted', () => {
    cy.get('#first-name')
      .type('Bob')
      .get('#last-name')
      .type('Loblaw')
      .get('#message')
      .type('The duck flies at midnight')

    cy.get('#submit-button')
      .click()

    cy.get('body')
      .should('not.contain', 'The first name field is required')
      .should('not.contain', 'The last name field is required')
      .should('contain', 'The email field is required')
      .should('not.contain', 'The message field is required')
  })

  it('Displays an error message if the message is not completed and submission is attempted', () => {
    cy.get('#first-name')
      .type('Bob')
      .get('#last-name')
      .type('Loblaw')
      .get('#email')
      .type('b.loblaw@example.com')

    cy.get('#submit-button')
      .click()

   cy.get('body')
      .should('not.contain', 'The first name field is required')
      .should('not.contain', 'The last name field is required')
      .should('not.contain', 'The email field is required')
      .should('contain', 'The message field is required')
  })

  it('Displays a count of the message length', () => {
    let message = 'The duck flies at midnight'

    cy.get('#message')
      .type(message)

    cy.get('body')
      .contains(`Message Length: ${message.length}`).should('be.visible')
  })

  it('Clears the form and error messages when clicking clear', () => {
    cy
      .get('#first-name').type('Bob').should('have.value', 'Bob')
      .get('#last-name').type('Loblaw').should('have.value', 'Loblaw')
      .get('#email').type('b.loblaw@example.com').should('have.value', 'b.loblaw@example.com')
      .get('#submit-button').click()
      .get('body').should('contain', 'The message field is required')

    cy.get('#clear-button')
      .click()

    cy.get('#first-name').should('have.value', '')
      .get('#last-name').should('have.value', '')
      .get('#email').should('have.value', '')
      .get('#message').should('have.value', '')
      .get('body').should('contain', `Message Length: 0`).should('not.contain', 'The message field is required')
  })

  it('Displays a thank you message after submitting', () => {
    cy
      .get('#first-name').type('Bob')
      .get('#last-name').type('Loblaw')
      .get('#email').type('b.loblaw@example.com')
      .get('#message').type('The duck flies at midnight')

    cy.get('#submit-button').click()

    cy.get('body').should('contain', `Thank you for your submission Bob!`)
  })
})