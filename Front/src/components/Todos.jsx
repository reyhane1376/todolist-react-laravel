import { useState, useEffect } from 'react';
import fetchGraphQL from '../graphqlService';
import TodoList from './TodoList';

export default function Todos() {
    const [todos, setTodos] = useState([]);
    const [newTodoTitle, setNewTodoTitle] = useState('');
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    const GET_TODO_LIST_QUERY = `
        query {
            todolists {
                id
                title
                status
                created_at
            }
        }
    `;

    const CREATE_TODO_MUTATION = `
        mutation($title: String!) {
            createTodo(title: $title) {
                id
                title
                status
                created_at
            }
        }
    `;


    const fetchTodos = async () => {
        setLoading(true);
        setError(null);
        try {
            const data = await fetchGraphQL(GET_TODO_LIST_QUERY);
            setTodos(data.todolists);
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchTodos();
    }, []);

    const onInputNewTodoChangeHandler = (event) => {
        setNewTodoTitle(event.target.value);
    };
    
    const addNewTodoHandler = async (event) => {
        if (event.key === 'Enter' && newTodoTitle !== '') {
            try {
                const data = await fetchGraphQL(CREATE_TODO_MUTATION, { title: newTodoTitle });
                const newTodo = data.createTodo;
    
                setTodos([...todos, newTodo]);
                setNewTodoTitle('');
            } catch (err) {
                setError(err.message);
            }
        }
    };

    const deleteTodoHandler = (todo) => {
        setTodos(todos.filter((todoItem) => todo.id !== todoItem.id));
    };

    const toggleTodoStatusHandler = (todo) => {
        setTodos(
            todos.map((todoItem) =>
                todo.id === todoItem.id
                    ? { ...todoItem, status: !todoItem.status }
                    : todoItem
            )
        );
    };

    const editTodoTitleHandler = (todo, newTitleValue) => {
        setTodos(
            todos.map((todoItem) =>
                todo.id === todoItem.id
                    ? { ...todoItem, title: newTitleValue }
                    : todoItem
            )
        );
    };

    if (loading) return <p>Loading...</p>;
    if (error) return <p>Error: {error}</p>;

    return (
        <div className="flex items-center justify-center">
            <div className="w-full px-4 py-8 mx-auto shadow lg:w-1/3 bg-white">
                <div className="flex items-center mb-6">
                    <h1 className="mr-6 text-4xl font-bold text-purple-600">TO DO APP</h1>
                </div>
                <div className="relative">
                    <input
                        type="text"
                        placeholder="What needs to be done today?"
                        onChange={onInputNewTodoChangeHandler}
                        onKeyDown={addNewTodoHandler}
                        value={newTodoTitle}
                        className="w-full px-2 py-3 border rounded outline-none border-grey-600"
                    />
                </div>
                <TodoList
                    todos={todos}
                    deleteTodo={deleteTodoHandler}
                    toggleTodoStatus={toggleTodoStatusHandler}
                    editTodoTitle={editTodoTitleHandler}
                />
            </div>
        </div>
    );
}
