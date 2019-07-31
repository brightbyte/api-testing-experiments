Feature: action API
    In order to confidently refactor code
    as a developer
    I want to see if the action API works as expected

    Scenario: CRUD
        When I send a POST request to "/api.php?action=edit&format=json" with form data:
            """
            title=BehatTest
            createonly=1
            summary=testing
            text=some+text
            token=%2B%5C
            """
        Then response code should be 200
            And field "edit/result" in the response should be "Success"

        When I send a GET request to "/api.php?action=parse&page=BehatTest&format=json"
        Then response code should be 200
          And the response should contain "some text"

      When I send a POST request to "/api.php?action=edit&format=json" with form data:
            """
            title=BehatTest
            summary=testing
            text=different+text
            token=%2B%5C
            """
      Then response code should be 200
        And field "edit/result" in the response should be "Success"

      When I send a GET request to "/api.php?action=parse&page=BehatTest&format=json"
      Then response code should be 200
        And the response should contain "different text"

      When I send a POST request to "/api.php?action=delete&format=json" with form data:
            """
            title=BehatTest
            token=%2B%5C
            """
      Then response code should be 200
        And field "edit/result" in the response should be "Success"
