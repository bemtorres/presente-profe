<table>
  <thead>
      <tr>
          <th>ID</th>
          <th>Cliente</th>
      </tr>
  </thead>
  <tbody>
      @foreach ($horarios as $h)
          <tr>
              <td>{{ $h->id }}</td>
              <td>{{ $h->getDayText() }}</td>
          </tr>
      @endforeach
  </tbody>
</table>
