// graphqlService.js
const fetchGraphQL = async (query, variables = {}) => {
       const response = await fetch('http://localhost:8000/api/graphql', {
           method: 'POST',
           headers: {
               'Content-Type': 'application/json',
           },
           body: JSON.stringify({
               query,
               variables,
           }),
       });
   
       if (!response.ok) {
           throw new Error(`GraphQL query failed with status: ${response.status}`);
       }
   
       const result = await response.json();
       if (result.errors) {
           throw new Error(`GraphQL errors: ${JSON.stringify(result.errors)}`);
       }
   
       return result.data;
   };
   
   export default fetchGraphQL;
   