Feature: `wp tencho hello` tasks

	Scenario: The `tencho hello` command should be enabled.
    When I try `wp tencho hello`
    Then the return code should be 0
	Then the output should not be empty
	Then the output contain in the tencho words
