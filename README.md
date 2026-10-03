Q1. Your form sends data with POST rather than GET. Explain what would go wrong if it used GET instead. Your answer should say something about what a browser does when a page is refreshed.
Answer: if the form is use GET, all the input data would be appended to the URL as a query string. Refreshing a page simply re-requests the same URL, and the browser does this silently for GET requests since it considers them harmless. That means every refresh would resubmit the exact same data and create a duplicate record.

Q2. When validation fails, your controller does not run the code that saves the record — and you did not write an if statement to stop it. Explain what actually stops it, and where the visitor ends up.
Answer: the validation call itself stops execution. When a rule fails it throws a validationexception internally, and since I never catch that exception, the rest of the method save and redirect lines simply never runs. 

Q3. Your success message is displayed from the layout, which renders on every page. Explain why it does not appear on every page.
Answer: the check lives in the layout, but the data it checks the session('success') this is only set right after a successful save and using ->with('success', 'Product added successfully!') the session flash data like this is only available for the very next request.